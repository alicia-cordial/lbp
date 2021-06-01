<?php
require_once('Database.php');

class AdminModel extends Database
{
    public function showUsers($choice)
    {
        if ($choice === "all") {
            $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE droit = 0");
            $request->execute();
        } else {
            $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE status = ? AND droit = 0");
            $request->execute([$choice]);
        }
        $users = $request->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
}
//$model = new AdminModel();
//var_dump($model->showUsers('vendeur'));