<?php
namespace OCA\Unban\Controller;

use OCP\IRequest;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
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
		return new TemplateResponse('unban', 'index');  // templates/index.php
    }
    
    public function showBan(int $id){
        return new TemplateResponse('unban', 'showBan');
    }

    public function deleteBan(int $id){
        return new TemplateResponse('unban', 'deleteBan');   
    }

}
