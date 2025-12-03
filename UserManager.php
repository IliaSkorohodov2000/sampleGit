<?php

interface UserLogger {
    public function logUserAddition($name);
	
	public function logUserDeletionByIndex($index);
}

interface EmailSender {
    public function sendWelcomeEmail($email);
}

class ConsoleLogger implements UserLogger {
    public function logUserAddition($name) {
        echo "User added: " . $name . "\n";
    }
	
	public function logUserDeletionByIndex($index) {
        echo "User deleted at index: " . $index . "\n";
    }
}

class FileLogger implements UserLogger {
    public function logUserAddition($name) {
		//placeholder for file logging
        echo "[Logged to file] User added: " . $name . "\n";
    }
	
	public function logUserDeletionByIndex($index) {
		//placeholder for file logging
        echo "[Logged to file] User deleted at index: " . $index . "\n";
    }
}

class ConsoleEmailSender implements EmailSender {
    public function sendWelcomeEmail($email) {
        echo "Welcome email sent to: " . $email . "\n";
    }
}

class UserManager {
    private $users = [];
    private UserLogger $logger;
    private EmailSender $emailSender;

    public function __construct(UserLogger $logger, EmailSender $emailSender) {
        $this->logger = $logger;
        $this->emailSender = $emailSender;
    }

    public function addUser($name, $email) {
        $this->users[] = ['name' => $name, 'email' => $email];
        $this->logger->logUserAddition($name);
        $this->emailSender->sendWelcomeEmail($email);
    }

    public function getUser($index) {
        return $this->users[$index] ?? null;
    }

    public function getAllUsers() {
        return $this->users;
    }

    public function updateUser($index, $name, $email) {
        if (isset($this->users[$index])) {
            $this->users[$index] = ['name' => $name, 'email' => $email];
            $this->logger->logUserAddition($name);
        }
    }

    public function deleteUser($index) {
        if (isset($this->users[$index])) {
            unset($this->users[$index]);
            $this->logger->logUserDeletionByIndex($index);
        }
    }
}

// Example usage
$logger = new ConsoleLogger();
$emailSender = new ConsoleEmailSender();
$userManager = new UserManager($logger, $emailSender);
$userManager->addUser("John Doe", "john@example.com");
$userManager->addUser("Jane Smith", "jane@example.com");
print_r($userManager->getAllUsers());
$userManager->deleteUser(0);
print_r($userManager->getAllUsers());
?>