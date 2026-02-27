<?php

//   admin login handler
//    check creds, and if they pass , start the admin session
//   kept this simple on purpose so its easy to explain 
 

session_start();
require_once '../includes/init.php';

use Portfolio\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    // quick check so blank fields dont keep going
    if (empty($username) || empty($password)) {
        header('Location: login_form.php?error=1');
        exit();
    }
    
    try {
        $db = new Database();
        
        // make sure admins table exists, helps on a fresh db setup
        $db->execute("CREATE TABLE IF NOT EXISTS admins (
            admin_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            admin_username VARCHAR(50) NOT NULL UNIQUE,
            admin_password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        
        // get the matching admin row by username
        $users = $db->query('SELECT admin_id, admin_username, admin_password FROM admins WHERE admin_username = :username', [
            'username' => $username
        ]);
        $user = !empty($users) ? $users[0] : null;
        
        // if user not found, allow first-time bootstrap admin
        if (!$user) {
            $counts = $db->query('SELECT COUNT(*) as cnt FROM admins');
            $adminCount = (int) ($counts[0]['cnt'] ?? 0);
            if ($adminCount === 0 && $username === 'admin' && $password === 'admin123') {
                // create default admin for first login
                $hash = password_hash('admin123', PASSWORD_DEFAULT);
                $db->execute('INSERT INTO admins (admin_username, admin_password) VALUES (:username, :password)', [
                    'username' => $username,
                    'password' => $hash
                ]);
                $user = [
                    'admin_id' => $db->lastInsertId(),
                    'admin_username' => $username,
                    'admin_password' => $hash
                ];
            }
        }

        // verify pass
        $valid = false;
        if ($user) {
            // normal password check
            if (password_verify($password, $user['admin_password'])) {
                $valid = true;
            } else {
                // older sql dumps had an example hash for "password"
                // if we see that old hash, let admin123 in once and fix it
                $exampleHash = '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P0dKtS';
                if ($username === 'admin' && $password === 'admin123' && $user['admin_password'] === $exampleHash) {
                    $valid = true;
                    // re-hash and store the right password
                    $newHash = password_hash('admin123', PASSWORD_DEFAULT);
                    $db->execute('UPDATE admins SET admin_password = :h WHERE admin_id = :id', [
                        'h' => $newHash,
                        'id' => $user['admin_id']
                    ]);
                }
            }
        }

        if ($valid) {
            // login ok, save session values
            $_SESSION['admin_id'] = $user['admin_id'];
            $_SESSION['admin_username'] = $user['admin_username'];
            header('Location: project_list.php');
            exit();
        } else {
            // bad login
            header('Location: login_form.php?error=1');
            exit();
        }
    } catch (Exception $e) {
        error_log("Login error: " . $e->getMessage());
        header('Location: login_form.php?error=1');
        exit();
    }
} else {
    // only POST should hit this file
    header('Location: login_form.php');
    exit();
}
?>
