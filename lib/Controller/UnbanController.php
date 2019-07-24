<?php
namespace OCA\Unban\Controller;

use OCP\IRequest;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\RedirectResponse;
use OCP\AppFramework\Controller;

class UnbanController extends Controller {
	private $userId;

	public function __construct($AppName, IRequest $request, $UserId){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
	}

	/**
	 * @NoAdminRequired
     * @NoCSRFRequired
	 */
	public function index(){

		// Affiche ce qu'il y a dans le fichier
		/*$fileIp = "/home/user/Documents/ipBanNextcloud";
		$handle = fopen($fileIp, "r");
		$ipBan = fread($handle, filesize($fileIp));
		fclose($handle);*/

		exec('cat /home/user/Documents/ipBanNextcloud', $ipBan);

		// Compte le nombre de lignes
		$numberIp = count($ipBan);
		
		
		if(!file_exists('/home/user/Documents/ipBanNextcloud')){
			$noFile = "Il n'y a pas de fichier";
			return $noFile;

		}elseif($numberIp <= 0){
			$noBan = "Il n'y a pas d'utilisateur banni";
			return $noBan;

        }else{
			return $ipBan;
			
		}
		
		return new Response('UnbanController', $ipBan);
    }

     /**
	 * @NoAdminRequired
     * @NoCSRFRequired
	 * @param int $id
	 */
    public function delete(int $id){

		// Affiche ce qu'il y a dans le fichier
		exec('cat /home/user/Documents/ipBanNextcloud', $ipBan);

		// Compte le nombre de lignes
		$numberIp = count($ipBan);

		/* On ouvre le fichier. Ligne par ligne on vérifie 
		 * si le numéro de la ligne n'est pas l'id que l'on 
		 * veut supprimer. Toutes les lignes sont réécrite 
		 * dans un autre fichier sauf la ligne égale à l'id. 
		 * Pour terminer, suppression de l'ancien fichier et
		 * renommage du nouveau.
		 */ 
		$numberLine = -1;
		$handle = fopen('/home/user/Documents/ipBanNextcloud', 'r');

		if(preg_match("#^\d+$#", $id)){
			if($id > -1 && $id < $numberIp){
				while(!feof($handle)){
					$line = fgets($handle);
					$numberLine++;
		
					if($numberLine !== $id){
						file_put_contents('/home/user/Documents/ipBanNextcloud2', $line, FILE_APPEND);
					}
				}
				fclose($handle);
				
				unlink('/home/user/Documents/ipBanNextcloud');
				rename('/home/user/Documents/ipBanNextcloud2', '/home/user/Documents/ipBanNextcloud');
	
				return new RedirectResponse("/index.php/apps/unban/unban");
				
			}else{
				$ipDontExist = "L'ip avec l'id ".$id." n'existe pas";
				return $ipDontExist;

			}
		}else{
			$noInt = "La donnée envoyée n'est pas un chiffre";
			return $noInt;

		}
	}
}
