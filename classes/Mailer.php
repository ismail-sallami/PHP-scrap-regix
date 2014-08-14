<?php


class Mailer {
	const STRIP_RETURN_PATH = TRUE;
	
	private $to = NULL;
	private $subject = NULL;
	private $textMessage = NULL;
	private $headers = NULL;
	private $recipients = NULL;
	private $from = "Regis 24 admin <regis24admin@regis24.de>"; //modify this
	private $replyTo = NULL;
	
	
	public function __construct($to = NULL, $subject = NULL, $textMessage = NULL, $headers = NULL) {
		$this->to = $to;
		$this->recipients = $to;
		$this->subject = $subject;
		$this->textMessage = $textMessage;
		$this->headers = $headers;
		return $this;
	}
	
	public function send() {
		if (is_null($this->to)) {
			throw new Exception("Must have at least one recipient.");
		}
		
		if (is_null($this->from)) {
			throw new Exception("Must have one, and only one sender set.");
		}
		
		if (is_null($this->subject)) {
			throw new Exception("Subject is empty.");
		}
		
		if (is_null($this->textMessage)) {
			throw new Exception("Message is empty.");
		}
		
		$this->packHeaders();
		$sent = mail($this->to, $this->subject, $this->textMessage, $this->headers);
		if(!$sent) {
			$errorMessage = "Server couldn't send the email.";
			throw new Exception($errorMessage);
		} else {
			return true;
		}
	}
	
	public function addRecipient($address) {
		$this->recipients .= (is_null($this->recipients)) ?  ("$address") : (", " . "$address");
		$this->to .= (is_null($this->to)) ?  $address : (", " . $address);
		return $this;
	}
	
	public function setReplyTo($address) {
		$this->replyTo = $address . PHP_EOL;
		return $this;
	}
	
	public function fillSubject($subject) {
		$this->subject = $subject;
		return $this;
	}
	
	public function fillMessage($textMessage) {
		$this->textMessage = $textMessage;
		return $this;
	}
	
	private function packHeaders() {
		if (!$this->headers) {
			$this->headers = "MIME-Version: 1.0" . PHP_EOL;
			$this->headers .= "To: " . $this->recipients . PHP_EOL;
			$this->headers .= "From: " . $this->from . PHP_EOL;
			
			if (self::STRIP_RETURN_PATH !== TRUE) {
				$this->headers .= "Reply-To: " . $this->replyTo . PHP_EOL;
				$this->headers .= "Return-Path: " . $this->from . PHP_EOL;
			}
			
		}
	}
}

?>
