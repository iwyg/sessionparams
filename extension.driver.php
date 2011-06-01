<?php

	Class extension_sessionparams extends Extension{
	
		public function about(){
			return array('name' => 'Session Params',
						 'version' => '1.0',
						 'release-date' => '2011-06-01',
						 'author' => array('name' => 'Thomas Appel',
										   'website' => 'http://thomas-appel.com',
										   'email' => 'mail@thomas-appel.com')
				 		);
		}
		
		public function getSubscribedDelegates(){
			return array(
						array(
							'page' => '/frontend/',
							'delegate' => 'FrontendParamsPostResolve',
							'callback' => 'addSessionValuesToPageParam'
						),						
			);
		}	
		
		public function addSessionValuesToPageParam($context){
			
			session_start();
			
			if(!is_array($_SESSION[__SYM_COOKIE_PREFIX__ . '-sessionmonster']) || empty($_SESSION[__SYM_COOKIE_PREFIX__ . '-sessionmonster'])) return NULL;			

			foreach($_SESSION[__SYM_COOKIE_PREFIX__ . '-sessionmonster'] as $key => $val){
				if(strlen($val) <= 0) continue;		
				$context['params']['session-params-' . $key] = $val;
	        }			
		}
	}

