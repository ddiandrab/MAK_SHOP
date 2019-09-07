<?php
	include_once("model.php");

	class controller_products {
		public $model;

		public function __construct(){
			$this->model = new model_products();
		}

		public function invoke(){
			session_start();
			
				if(isset($_GET['edit'])){
					$data = $this->model->getProducts($_GET['$id_edit']);
					include "../products.php?edit=".$id_edit;
					if (isset($_POST['Edit'])){
						$add= $this->model->updateProducts($_GET['title'], $_POST['price'], $_POST['list_price'], $_POST['categories'], $_POST['image'], $_POST['description']);
						header('Location: ../products.php');
					}
				}
				else if(isset($_GET['delete'])){
					$del= $this->model->deletePogramKerja($_GET['nomorProgram']);
					header('Location:index.php');
				}
				else if(isset($_GET['tambah'])){
					include 'v_Tambah.php';
					if (isset($_POST['Add'])){
						$add= $this->model->setPogramKerja($_POST['nomorProgram'], $_POST['namaProgram'], $_POST['suratKeterangan']);
						header('Location:index.php');
					}
				}
				else if(isset($_GET['Logout'])){
					$logout= $this->model->Logout();
					header('Location:index.php');
				}
				else{
					$proker = $this->model->getSemuaPogramKerja();
					Include 'v_programKerja(CRUD).php';
				}
		}
	}
?>
