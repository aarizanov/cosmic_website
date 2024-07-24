<?php
class cdMailChimp {
    private $listId = '235d1b1b1f';
    private $apiKey = '17c7127357fb67ac31ccd01883f49a4a-us4';
    private $mailChimp;
    private $data;

    public function __construct() {
        require_once get_template_directory() . '/inc/lib/MailChimp.php';
        $this->mailChimp = new \DrewM\MailChimp\MailChimp($this->apiKey);
        $this->data = $_POST;
    }

    public function callBack() {
        $this->data['name'] = explode(' ', $this->data['name']);
        $this->data = [
            'frequency' => $this->data['frequency'],
            'email' => $this->data['email'],
            'fname' => array_shift($this->data['name']),
            'lname' => implode(' ', $this->data['name']),
        ];

        $this->validate();

        $result = $this->checkErrors($this->save($this->data));

        if(isset($result['status']) && $result['status'] === 'subscribed') {
            $this->finish(['status' => 200, 'message' => 'Thanks for subscribing!', 'original' => $result]);
        }

        $this->finish(['status' => 400, 'message' => 'Error, something went wrong!', 'original' => $result]);
    }

    private function save($data)
    {
        return $this->mailChimp->post("lists/$this->listId/members", [
            'email_address' => $data['email'],
            'status' => 'subscribed',
            'tags' => [$data['frequency']],
            "merge_fields" => [
                "FNAME" => $data['fname'],
                "LNAME" => $data['lname'],
            ],
        ]);
    }

    private function update($data)
    {
        $subscriber_hash = \DrewM\MailChimp\MailChimp::subscriberHash($data['email']);

        return $this->mailChimp->patch("lists/$this->listId/members/$subscriber_hash", [
            'status' => 'subscribed',
            "merge_fields" => [
                "FNAME" => $data['fname'],
                "LNAME" => $data['lname'],
            ],
        ]);
    }

    private function checkErrors($data) {
        if(stripos($data['detail'], 'Use PUT to insert or update') !== false) {
            return $this->update($this->data);
        }

        return $data;
    }

    private function validate() {
        $re = '/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i';
        if(!preg_match($re, $this->data['email'], $matches, PREG_OFFSET_CAPTURE, 0)) {
            $this->finish(['status' => 400, 'message' => 'Sorry, it looks like your email address is incorrect. Please check it and try again.']);
        }
        if(!in_array($this->data['frequency'], ['monthly', 'quarterly', 'yearly'])) {
            $this->finish(['status' => 400, 'message' => 'Sorry, newsletter frequency not valid!']);
        }
    }

    private function finish($data) {
        if($data['status'] !== 200) {
            wp_send_json_error($data, $data['status']);
        } else {
            wp_send_json($data);
        }
    }
}
