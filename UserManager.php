<?php

class UserManager {
    private $users = [];

    public function addUser($name, $email) {
        $this->users[] = ['name' => $name, 'email' => $email];
        $this->logUserAddition($name);
        $this->sendWelcomeEmail($email);
    }

    private function logUserAddition($name) {
        // Logging logic
        echo "User added: " . $name . "\n";
    }

    private function sendWelcomeEmail($email) {
        // Email sending logic
        echo "Welcome email sent to: " . $email . "\n";
    }

    public function getUser($index) {
        if (isset($this->users[$index])) {
            return $this->users[$index];
        }
        return null;
    }

    public function getAllUsers() {
        return $this->users;
    }

    public function updateUser($index, $name, $email) {
        if (isset($this->users[$index])) {
            $this->users[$index] = ['name' => $name, 'email' => $email];
            $this->logUserAddition($name);
        }
    }

    public function deleteUser($index) {
        if (isset($this->users[$index])) {
            unset($this->users[$index]);
            echo "User deleted at index: " . $index . "\n";
        }
    }
}

// Example usage
$userManager = new UserManager();
$userManager->addUser("John Doe", "john@example.com");
$userManager->addUser("Jane Smith", "jane@example.com");
print_r($userManager->getAllUsers());
$userManager->deleteUser(0);
print_r($userManager->getAllUsers());
?>