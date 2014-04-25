<?php
class Noticias_model extends CI_Model {

	function query_comentarios($id_usuario, $last_id)
	{
		$query = $this->db->query("SELECT C.id_comentario, C.comentario, C.imagen,
										CASE 
											WHEN TIMESTAMPDIFF(SECOND, C.fecha_registro, now())<60 THEN CONCAT_WS(' ', 'Hace', TIMESTAMPDIFF(SECOND, C.fecha_registro, now()), 'segundos')
											WHEN TIMESTAMPDIFF(MINUTE, C.fecha_registro, now())=1 THEN 'Hace un minuto aproximadamente'
											WHEN TIMESTAMPDIFF(MINUTE, C.fecha_registro, now())<60 THEN CONCAT_WS(' ', 'Hace', TIMESTAMPDIFF(MINUTE, C.fecha_registro, now()), 'minutos')
											WHEN TIMESTAMPDIFF(HOUR, C.fecha_registro, now())=1 THEN 'Hace una hora aproximadamente'
											WHEN TIMESTAMPDIFF(HOUR, C.fecha_registro, now())<24 THEN CONCAT_WS(' ', 'Hace', TIMESTAMPDIFF(HOUR, C.fecha_registro, now()), 'horas')
											WHEN TIMESTAMPDIFF(DAY, C.fecha_registro, now())=1 THEN 'Ayer' ELSE CONCAT_WS(' ', DATE_FORMAT(C.fecha_registro, '%e-%m-%Y'), 'a las', DATE_FORMAT(C.fecha_registro, '%H:%m'))
										END AS 'cuando',
										U.usuario AS nombre,
										U.foto,
										S.total_subcomentarios,
										L.total_me_gusta,
										CASE WHEN L.me_gusta IS NULL THEN 'text-muted' ELSE L.me_gusta END AS me_gusta,
										L.total_no_me_gusta,
										CASE WHEN L.no_me_gusta IS NULL THEN 'text-muted' ELSE L.no_me_gusta END AS no_me_gusta
									FROM comentarios AS C
									INNER JOIN usuarios AS U ON C.id_usuario=U.id_usuario
									LEFT JOIN 
									(
										SELECT id_comentario, SUM(CASE WHEN id_subcomentario IS NOT NULL THEN 1 END) AS total_subcomentarios
										FROM subcomentarios
										GROUP BY id_comentario
									) AS S ON C.id_comentario=S.id_comentario 
									LEFT JOIN (									
										SELECT id, 
										SUM(CASE WHEN tipo_like=1 THEN 1 END) AS total_me_gusta, CASE WHEN id_usuario=1 AND tipo_like=1 THEN 'text-bold' ELSE 'text-muted' END AS me_gusta,
										SUM(CASE WHEN tipo_like=2 THEN 1 END) AS total_no_me_gusta, CASE WHEN id_usuario=1 AND tipo_like=2 THEN 'text-bold' ELSE 'text-muted' END AS no_me_gusta
										FROM likes
										WHERE tipo_comentario=1
										GROUP BY id
									) AS  L ON C.id_comentario=L.id
									WHERE (C.id_usuario=$id_usuario OR C.id_usuario IN (
										SELECT CASE WHEN id_usuario=$id_usuario THEN 
										id_usuario_amigo ELSE id_usuario END AS id_usuario 
										FROM amigos WHERE (id_usuario=$id_usuario OR id_usuario_amigo=$id_usuario) AND aceptado=1 AND borrado=0)) AND C.borrado=0 AND C.id_comentario$last_id
									GROUP BY C.id_comentario
									ORDER BY C.fecha_registro DESC
									LIMIT 5");
		return $query->result(); 
	}

	function query_subcomentarios($id_comentario)
	{
		$query = $this->db->query("SELECT S.id_subcomentario, S.id_comentario, S.subcomentario,
										CASE 
											WHEN TIMESTAMPDIFF(SECOND, S.fecha_registro, now())<60 THEN CONCAT_WS(' ', 'Hace', TIMESTAMPDIFF(SECOND, S.fecha_registro, now()), 'segundos')
											WHEN TIMESTAMPDIFF(MINUTE, S.fecha_registro, now())=1 THEN 'Hace un minuto aproximadamente'
											WHEN TIMESTAMPDIFF(MINUTE, S.fecha_registro, now())<60 THEN CONCAT_WS(' ', 'Hace', TIMESTAMPDIFF(MINUTE, S.fecha_registro, now()), 'minutos')
											WHEN TIMESTAMPDIFF(HOUR, S.fecha_registro, now())=1 THEN 'Hace una hora aproximadamente'
											WHEN TIMESTAMPDIFF(HOUR, S.fecha_registro, now())<24 THEN CONCAT_WS(' ', 'Hace', TIMESTAMPDIFF(HOUR, S.fecha_registro, now()), 'horas')
											WHEN TIMESTAMPDIFF(DAY, S.fecha_registro, now())=1 THEN 'Ayer' ELSE CONCAT_WS(' ', DATE_FORMAT(S.fecha_registro, '%e-%m-%Y'), 'a las', DATE_FORMAT(S.fecha_registro, '%H:%m'))
										END AS 'cuando',
										U.usuario AS nombre,
										U.foto,
										L.total_me_gusta,
										CASE WHEN L.me_gusta IS NULL THEN 'text-muted' ELSE L.me_gusta END AS me_gusta,
										L.total_no_me_gusta,
										CASE WHEN L.no_me_gusta IS NULL THEN 'text-muted' ELSE L.no_me_gusta END AS no_me_gusta
									FROM subcomentarios AS S
									INNER JOIN usuarios AS U ON S.id_usuario=U.id_usuario
									LEFT JOIN (									
										SELECT id, 
										SUM(CASE WHEN tipo_like=1 THEN 1 END) AS total_me_gusta, CASE WHEN id_usuario=1 AND tipo_like=1 THEN 'text-bold' ELSE 'text-muted' END AS me_gusta,
										SUM(CASE WHEN tipo_like=2 THEN 1 END) AS total_no_me_gusta, CASE WHEN id_usuario=1 AND tipo_like=2 THEN 'text-bold' ELSE 'text-muted' END AS no_me_gusta
										FROM likes
										WHERE tipo_comentario=2
										GROUP BY id
									) AS  L ON S.id_comentario=L.id
									WHERE S.id_comentario=$id_comentario AND S.borrado=0
									ORDER BY S.fecha_registro ASC");
		return $query->result(); 
	}

	function query_emoticones()
	{
		$query = $this->db->query("SELECT signo, emoticon FROM emoticones");

		return $query->result();
	}

	function query_insertar_like($tipo_comentario,$tipo_like,$id_comentario,$status,$id_usuario)
	{
		$query = $this->db->query("CALL inserta_like ('$tipo_comentario', '$tipo_like', '$id_comentario', '$status', '$id_usuario')");

		return $query->row();
	}

	function query_actualizar_likes($id_comentario, $tipo_comentario)
	{
		
		$query = $this->db->query("CALL actualizar_like($id_comentario, $tipo_comentario)");
		
		return $query->row();	
	}


	function query_insertar_comentario($id_usuario, $comentario, $imagen)
	{
		$query = $this->db->query("INSERT INTO comentarios (comentario, imagen, id_usuario) VALUES('$comentario', '$imagen', $id_usuario)");
		
		return $this->db->insert_id();	
	}


	function query_insertar_subcomentario($id_usuario, $id_comentario, $subcomentario)
	{
		$query = $this->db->query("INSERT INTO subcomentarios (id_comentario, subcomentario, id_usuario) VALUES($id_comentario, '$subcomentario', $id_usuario)");
		
		return $this->db->insert_id();	
	}
}