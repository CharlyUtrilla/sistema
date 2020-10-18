<?php
	require_once('includes/load.php');
	function find_all($table){
		global $db;
		if(tableExists($table)){
			return find_by_sql("SELECT * FROM ".$db->escape($table));
		}
	}
	function find_by_sql($sql){
		global $db;
		$result=$db->query($sql);
		$result_set=$db->while_loop($result);
		return $result_set;
	}
	function find_by_id($table,$id){
		global $db;
		$id=(int)$id;
		if(tableExists($table)){
			$sql=$db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
			if($result=$db->fetch_assoc($sql))
				return $result;
			else
				return null;
		}
	}
	function delete_by_id($table,$id){
		global $db;
		if(tableExists($table)){
			$sql="DELETE FROM ".$db->escape($table);
			$sql.=" WHERE id=".$db->escape($id);
			$sql.=" LIMIT 1";
			$db->query($sql);
			return ($db->affected_rows()===1) ? true : false;
		}
	}
	function count_by_id($table){
		global $db;
		if(tableExists($table)){
			$sql="SELECT COUNT(id) AS total FROM ".$db->escape($table);
			$result=$db->query($sql);
			return($db->fetch_assoc($result));
		}
	}
	function tableExists($table){
	global $db;
	$table_exit=$db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
		if($table_exit){
			if($db->num_rows($table_exit)>0){
				return true;
			}else{
				return false;
			}
		}
	}
	function authenticate($username='',$password=''){
		global $db;
		$username=$db->escape($username);
		$password=$db->escape($password);
		$sql=sprintf("SELECT id,username,password,user_level FROM users WHERE username='%s' LIMIT 1",$username);
		$result=$db->query($sql);
		if($db->num_rows($result)){
			$user=$db->fetch_assoc($result);
			$password_request=sha1($password);
			if($password_request===$user['password']){
				return $user['id'];
			}
		}
		return false;
	}
	function authenticate_v2($username='',$password=''){
		global $db;
		$username=$db->escape($username);
		$password=$db->escape($password);
		$sql=sprintf("SELECT id,username,password,user_level FROM users WHERE username='%s' LIMIT 1",$username);
		$result=$db->query($sql);
		if($db->num_rows($result)){
			$user=$db->fetch_assoc($result);
			$password_request=sha1($password);
			if($password_request===$user['password']){
				return $user;
			}
		}
		return false;
	}
	function current_user(){
		static $current_user;
		global $db;
		if(!$current_user){
			if(isset($_SESSION['user_id'])):
				$user_id=intval($_SESSION['user_id']);
				$current_user=find_by_id('users',$user_id);
			endif;
		}
		return $current_user;
	}
	function find_all_user(){
		global $db;
		$results=array();
		$sql="SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,";
		$sql.="g.group_name ";
		$sql.="FROM users u ";
		$sql.="LEFT JOIN user_groups g ";
		$sql.="ON g.group_level=u.user_level ORDER BY u.name ASC";
		$result=find_by_sql($sql);
		return $result;
	}
	function updateLastLogIn($user_id){
		global $db;
		$date=make_date();
		$sql="UPDATE users SET last_login='{$date}' WHERE id='{$user_id}' LIMIT 1";
		$result=$db->query($sql);
		return ($result&&$db->affected_rows()===1 ? true : false);
	}
	function find_by_groupName($val){
		global $db;
		$sql="SELECT group_name FROM user_groups WHERE group_name='{$db->escape($val)}' LIMIT 1";
		$result=$db->query($sql);
		return($db->num_rows($result)===0 ? true : false);
	}
	function find_by_groupLevel($level){
		global $db;
		$sql="SELECT group_level FROM user_groups WHERE group_level='{$db->escape($level)}' LIMIT 1";
		$result=$db->query($sql);
		return($db->num_rows($result)===0 ? true : false);
	}
	function page_require_level($require_level){
		global $session;
		$current_user=current_user();
		$login_level=find_by_groupLevel($current_user['user_level']);
		if(!$session->isUserLoggedIn(true)):
            $session->msg('d','Por favor, inicia sesión.');
            redirect('index.php', false);
		elseif($login_level['group_status']==='0'):
			$session->msg('d','Este nivel de usaurio esta inactivo.');
			redirect('home.php',false);
		elseif($current_user['user_level']<=(int)$require_level):
            return true;
		else:
            $session->msg('d','No tienes permiso para ver esta página.');
            redirect('home.php',false);
        endif;
    }
	function join_product_table(){
		global $db;
		$sql="SELECT p.id,p.name,p.quantity,p.buy_price,p.sale_price,p.media_id,p.date,c.name";
		$sql.=" AS categorie,m.file_name AS image,p.id_supplier";
		$sql.=" FROM products p";
		$sql.=" LEFT JOIN categories c ON c.id=p.categorie_id";
		$sql.=" LEFT JOIN media m ON m.id=p.media_id";
		$sql.=" LEFT JOIN suppliers s ON s.id=p.id_supplier";
		$sql.=" ORDER BY p.id DESC";
		return find_by_sql($sql);
	}
	function find_product_by_title($product_name){
		global $db;
		$p_name=remove_junk($db->escape($product_name));
		$sql="SELECT name FROM products WHERE name like '%$p_name%' LIMIT 5";
		$result=find_by_sql($sql);
		return $result;
	}
	function find_all_product_info_by_title($title){
		global $db;
		$sql="SELECT * FROM products";
		$sql.=" WHERE name='{$title}'";
		$sql.=" LIMIT 1";
		return find_by_sql($sql);
	}
	function update_product_qty_sale($qty,$p_id){
		global $db;
		$qty=(int)$qty;
		$id=(int)$p_id;
		$sql="UPDATE products SET quantity=quantity-'{$qty}' WHERE id='{$id}'";
		$result=$db->query($sql);
		return($db->affected_rows()===1 ? true : false);
	}
	function update_product_qty_purchase($qty,$p_id){
		global $db;
		$qty=(int)$qty;
		$id=(int)$p_id;
		$sql="UPDATE products SET quantity=quantity+'{$qty}' WHERE id='{$id}'";
		$result=$db->query($sql);
		return($db->affected_rows()===1 ? true : false);
	}
	function find_recent_product_added($limit){
		global $db;
		$sql="SELECT p.id,p.name,p.sale_price,p.media_id,c.name AS categorie,";
		$sql.="m.file_name AS image FROM products p";
		$sql.=" LEFT JOIN categories c ON c.id=p.categorie_id";
		$sql.=" LEFT JOIN media m ON m.id=p.media_id";
		$sql.=" ORDER BY p.id DESC LIMIT ".$db->escape((int)$limit);
		return find_by_sql($sql);
	}
	function find_higest_saleing_product($limit){
		global $db;
		$sql="SELECT p.name,COUNT(s.product_id) AS totalSold,SUM(s.qty) AS totalQty";
		$sql.=" FROM sales s";
		$sql.=" LEFT JOIN products p ON p.id=s.product_id";
		$sql.=" GROUP BY s.product_id";
		$sql.=" ORDER BY SUM(s.qty) DESC LIMIT ".$db->escape((int)$limit);
		return $db->query($sql);
	}
	function find_all_sale(){
		global $db;
		$sql="SELECT s.id,s.qty,s.price,s.total,s.date,p.name,s.client";
		$sql.=" FROM sales s";
		$sql.=" LEFT JOIN products p ON s.product_id=p.id";
		$sql.=" LEFT JOIN clients c ON s.client=c.id";
		$sql.=" ORDER BY s.date DESC";
		return find_by_sql($sql);
	}
	function find_recent_sale_added($limit){
		global $db;
		$sql="SELECT s.id,s.qty,s.price,s.date,p.name";
		$sql.=" FROM sales s";
		$sql.=" LEFT JOIN products p ON s.product_id=p.id";
		$sql.=" ORDER BY s.date DESC LIMIT ".$db->escape((int)$limit);
		return find_by_sql($sql);
	}
	function find_sale_by_dates($start_date,$end_date){
		global $db;
		$start_date=date("Y-m-d",strtotime($start_date));
		$end_date=date("Y-m-d",strtotime($end_date));
		$sql="SELECT s.date,p.name,p.sale_price,p.buy_price,s.client,";
		$sql.="COUNT(s.product_id) AS total_records,";
		$sql.="SUM(s.qty) AS total_sales,";
		$sql.="SUM(p.sale_price * s.qty) AS total_saleing_price,";
		$sql.="SUM(p.buy_price * s.qty) AS total_buying_price ";
		$sql.="FROM sales s ";
		$sql.="LEFT JOIN products p ON s.product_id=p.id";
		$sql.=" WHERE s.date BETWEEN '{$start_date}' AND '{$end_date}'";
		$sql.=" GROUP BY DATE(s.date),p.name";
		$sql.=" ORDER BY DATE(s.date) DESC";
		return $db->query($sql);
	}
	function dailySales($year,$month){
		global $db;
		$sql="SELECT s.qty,";
		$sql.=" DATE_FORMAT(s.date,'%Y-%m-%e') AS date,p.name,";
		$sql.="SUM(p.sale_price * s.qty) AS total_saleing_price";
		$sql.=" FROM sales s";
		$sql.=" LEFT JOIN products p ON s.product_id=p.id";
		$sql.=" WHERE DATE_FORMAT(s.date,'%Y-%m' )='{$year}-{$month}'";
		$sql.=" GROUP BY DATE_FORMAT(s.date,'%e'),s.product_id";
		return find_by_sql($sql);
	}
	function monthlySales($year){
		global $db;
		$sql="SELECT s.qty,";
		$sql.=" DATE_FORMAT(s.date,'%Y-%m-%e') AS date,p.name,";
		$sql.="SUM(p.sale_price * s.qty) AS total_saleing_price";
		$sql.=" FROM sales s";
		$sql.=" LEFT JOIN products p ON s.product_id=p.id";
		$sql.=" WHERE DATE_FORMAT(s.date,'%Y')='{$year}'";
		$sql.=" GROUP BY DATE_FORMAT(s.date,'%c'),s.product_id";
		$sql.=" ORDER BY date_format(s.date,'%c') DESC";
		return find_by_sql($sql);
	}
	function find_higest_purchasing_product($limit){
		global $db;
		$sql="SELECT p.name,COUNT(pu.product_id) AS totalBuy,SUM(pu.qty) AS totalQty";
		$sql.=" FROM purchases pu";
		$sql.=" LEFT JOIN products p ON p.id=pu.product_id";
		$sql.=" GROUP BY pu.product_id";
		$sql.=" ORDER BY SUM(pu.qty) DESC LIMIT ".$db->escape((int)$limit);
		return $db->query($sql);
	}
	function find_all_purchase(){
		global $db;
		$sql="SELECT pu.id,pu.qty,pu.price,pu.total,pu.date,p.name,pu.supplier";
		$sql.=" FROM purchases pu";
		$sql.=" LEFT JOIN products p ON pu.product_id=p.id";
		$sql.=" ORDER BY pu.date DESC";
		return find_by_sql($sql);
	}
	function find_recent_purchase_added($limit){
		global $db;
		$sql="SELECT pu.id,pu.qty,pu.price,pu.total,pu.date,p.name,pu.supplier";
		$sql.=" FROM purchases pu";
		$sql.=" LEFT JOIN products p ON pu.product_id=p.id";
		$sql.=" LEFT JOIN suppliers s ON pu.supplier=p.id_supplier";
		$sql.=" ORDER BY pu.date DESC LIMIT ".$db->escape((int)$limit);
		return find_by_sql($sql);
	}
	function find_purchase_by_dates($start_date,$end_date){
		global $db;
		$start_date=date("Y-m-d",strtotime($start_date));
		$end_date=date("Y-m-d",strtotime($end_date));
		$sql="SELECT pu.date,p.name,p.sale_price,p.buy_price,pu.supplier,";
		$sql.=" COUNT(pu.product_id) AS total_records,";
		$sql.=" SUM(pu.qty) AS total_purchases,";
		$sql.=" SUM(p.buy_price * pu.qty) AS total_purchasing_price,";
		$sql.=" SUM(p.sale_price * pu.qty) AS total_saleing_price ";
		$sql.=" FROM purchases pu ";
		$sql.=" LEFT JOIN products p ON pu.product_id=p.id";
		$sql.=" LEFT JOIN suppliers s ON pu.supplier=s.id";
		$sql.=" WHERE pu.date BETWEEN '{$start_date}' AND '{$end_date}'";
		$sql.=" GROUP BY DATE(pu.date),p.name";
		$sql.=" ORDER BY DATE(pu.date) DESC";
		return $db->query($sql);
	}
	function dailyPurchases($year,$month){
		global $db;
		$sql="SELECT pu.qty,";
		$sql.=" DATE_FORMAT(pu.date,'%Y-%m-%e') AS date,p.name,";
		$sql.=" SUM(p.buy_price * pu.qty) AS total_purchasing_price";
		$sql.=" FROM purchases pu";
		$sql.=" LEFT JOIN products p ON pu.product_id=p.id";
		$sql.=" WHERE DATE_FORMAT(pu.date,'%Y-%m')='{$year}-{$month}'";
		$sql.=" GROUP BY DATE_FORMAT(pu.date,'%e'),pu.product_id";
		return find_by_sql($sql);
	}
	function monthlyPurchases($year){
		global $db;
		$sql="SELECT pu.qty,";
		$sql.=" DATE_FORMAT(pu.date,'%Y-%m-%e') AS date,p.name,";
		$sql.=" SUM(p.buy_price * pu.qty) AS total_purchasing_price";
		$sql.=" FROM purchases pu";
		$sql.=" LEFT JOIN products p ON pu.product_id=p.id";
		$sql.=" WHERE DATE_FORMAT(pu.date,'%Y')='{$year}'";
		$sql.=" GROUP BY DATE_FORMAT(pu.date,'%c'),pu.product_id";
		$sql.=" ORDER BY date_format(pu.date,'%c') DESC";
		return find_by_sql($sql);
	}
	function find_all_car(){
		global $db;
		$sql="SELECT c.id,c.marca_modelo,c.poblacion,c.empleado,c.matricula,c.estado,c.fecha_compra,c.ultima_revision";
		$sql.=" FROM cars c";
		$sql.=" ORDER BY c.id DESC";
		return find_by_sql($sql);
	}
	function update_car($qty,$p_id){
		global $db;
		$qty=(int)$qty;
		$id=(int)$p_id;
		$sql="UPDATE products SET quantity=quantity+'{$qty}' WHERE id='{$id}'";
		$result=$db->query($sql);
		return($db->affected_rows()===1 ? true : false);
	}
	function join_employees_table(){
		global $db;
		$sql="SELECT e.id,e.foto,e.nombre,e.apellidos,e.dni";
		$sql.=",m.file_name AS image";
		$sql.=" FROM employees e";
		$sql.=" LEFT JOIN media m ON m.id=e.foto";
		$sql.=" ORDER BY e.id DESC";
		return find_by_sql($sql);
	}
	function find_all_shop(){
		global $db;
		$sql="SELECT s.id,s.direccion,s.cod_postal,s.poblacion,s.empleado,s.metros_cuadrados,s.alquiler,s.adquisicion";
		$sql.=" FROM shops s";
		$sql.=" ORDER BY s.id DESC";
		return find_by_sql($sql);
	}
	function find_all_material(){
		global $db;
		$sql="SELECT m.id,m.nombre,m.descripcion,m.cantidad,m.fecha_compra,m.precio_compra";
		$sql.=" FROM materials m";
		$sql.=" ORDER BY m.id DESC";
		return find_by_sql($sql);
	}
	function find_all_salary(){
		global $db;
		$sql="SELECT s.id,s.empleado,s.fecha,s.horas_base,s.horas_extra,s.pago_base,s.pago_extra,s.total_horas,s.total_pago";
		$sql.=" FROM salary s";
		$sql.=" LEFT JOIN employees e ON s.empleado=CONCAT_WS(',',e.apellidos,e.nombre)";
		$sql.=" ORDER BY s.id DESC";
		return find_by_sql($sql);
	}
	function employees(){
		global $db;
		$sql="SELECT CONCAT_WS(',',e.apellidos,e.nombre) AS empleado";
		$sql.=" FROM employees e";
		$sql.=" ORDER BY e.id DESC";
		return find_by_sql($sql);
	}
	function find_all_supplier(){
		global $db;
		$sql="SELECT s.id,s.nombre,s.direccion,s.poblacion,s.estado,s.telefono,s.descripcion,s.fecha_inicio,s.activo";
		$sql.=" FROM suppliers s";
		$sql.=" ORDER BY s.id DESC";
		return find_by_sql($sql);
	}
	function find_all_client(){
		global $db;
		$sql="SELECT c.id,c.nombre,c.direccion,c.poblacion,c.estado,c.telefono,c.descripcion,c.fecha_inicio,c.activo";
		$sql.=" FROM clients c";
		$sql.=" ORDER BY c.id DESC";
		return find_by_sql($sql);
	}
?>