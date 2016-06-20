<?php
class ControllerShippingfrenet extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('shipping/frenet');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('frenet', $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_edit'] = $this->language->get('text_edit');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_select_all'] = $this->language->get('text_select_all');
		$this->data['text_unselect_all'] = $this->language->get('text_unselect_all');

        $this->data['entry_msg_prazo'] = $this->language->get('entry_msg_prazo');
        $this->data['entry_frenet_key'] = $this->language->get('entry_frenet_key');
        $this->data['entry_frenet_key_codigo'] = $this->language->get('entry_frenet_key_codigo');
        $this->data['entry_frenet_key_senha'] = $this->language->get('entry_frenet_key_senha');

		$this->data['entry_cost'] = $this->language->get('entry_cost');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');


		$this->data['help_frenet_key'] = $this->language->get('help_frenet_key');
        $this->data['help_msg_prazo'] = $this->language->get('help_msg_prazo');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		$this->data['tab_general'] = $this->language->get('tab_general');
		
		$this->data['entry_postcode']= $this->language->get('entry_postcode');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		if (isset($this->error['postcode'])) {
			$this->data['error_postcode'] = $this->error['postcode'];
		} else {
			$this->data['error_postcode'] = '';
		}

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'text'      => $this->language->get('text_home'),
            'separator' => FALSE
        );
        $this->data['breadcrumbs'][] = array(
            'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
            'text'      => $this->language->get('text_shipping'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'href'      => $this->url->link('shipping/frenet', 'token=' . $this->session->data['token'], 'SSL'),
            'text'      => $this->language->get('heading_title'),
            'separator' => ' :: '
        );
		
   		$this->data['action'] = $this->url->link('shipping/frenet', 'token=' . $this->session->data['token'], 'SSL');
		
   		$this->data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['frenet_status'])) {
			$this->data['frenet_status'] = $this->request->post['frenet_status'];
		} else {
			$this->data['frenet_status'] = $this->config->get('frenet_status');
		}

		if (isset($this->request->post['frenet_postcode'])) {
			$this->data['frenet_postcode'] = $this->request->post['frenet_postcode'];
		} else {
			$this->data['frenet_postcode'] = $this->config->get('frenet_postcode');
		}
        if (isset($this->request->post['frenet_msg_prazo'])) {
            $this->data['frenet_msg_prazo'] = $this->request->post['frenet_msg_prazo'];
        } else {
            $this->data['frenet_msg_prazo'] = $this->config->get('frenet_msg_prazo');
        }

		if (isset($this->request->post['frenet_contrato_codigo'])) {
			$this->data['frenet_contrato_codigo'] = $this->request->post['frenet_contrato_codigo'];
		} else {
			$this->data['frenet_contrato_codigo'] = $this->config->get('frenet_contrato_codigo');
		}
		if (isset($this->request->post['frenet_contrato_senha'])) {
			$this->data['frenet_contrato_senha'] = $this->request->post['frenet_contrato_senha'];
		} else {
			$this->data['frenet_contrato_senha'] = $this->config->get('frenet_contrato_senha');
		}						

		if (isset($this->request->post['frenet_sort_order'])) {
			$this->data['frenet_sort_order'] = $this->request->post['frenet_sort_order'];
		} else {
			$this->data['frenet_sort_order'] = $this->config->get('frenet_sort_order');
		}

		$this->load->model('localisation/tax_class');

        $this->data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

        $this->load->model('localisation/geo_zone');

        $this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        $this->template = 'shipping/frenet.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'shipping/frenet')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
?>
