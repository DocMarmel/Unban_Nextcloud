<?php 
namespace OCA\Unban\Service;

class UnbanService{

    public function findAll(){
        // Affiche ce qu'il y a dans le fichier
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
    }

}