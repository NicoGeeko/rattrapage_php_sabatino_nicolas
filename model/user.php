<?php
    /**
     * Méthode qui vérifie si un user existe en BDD avec son email
     * @param email string email de l'utilisateur
     * @return bool true si existe sinon false
     */
    function isUserExistByEmail(string $email): bool {
        try {
                
                $email = $email;
                
                $request = "SELECT u.id_users FROM users AS u WHERE u.email = ?";
                
                $req = connectBDD()->prepare($request);
                
                $req->bindParam(1, $email, PDO::PARAM_STR);
                
                $req->execute();
                
                $data = $req->fetch(PDO::FETCH_ASSOC);
                
                if (empty($data)) {
                    return false;
                }
                return true;
            } catch (Exception $e) {
                return false;
            }
    }
        /**
     * Méthode qui  ajoute un user en BDD
     * @param array $user tableau de l'utilisateur
     * @return void ne retrourne rien
     */
    function saveUser(array $user): void {
        try {
                
                $firstname = $user["firstname"];
                $lastname = $user["lastname"];
                $email = $user["email"];
                $password = $user["password"];
                $request = "INSERT INTO users(firstname, lastname, email, password) VALUE (?,?,?,?)";

                
                $req = connectBDD()->prepare($request);
                
                $req->bindParam(1, $firstname, \PDO::PARAM_STR);
                $req->bindParam(2, $lastname, \PDO::PARAM_STR);
                $req->bindParam(3, $email, \PDO::PARAM_STR);
                $req->bindParam(4, $password, \PDO::PARAM_STR);
        
                
                $req->execute();
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
    }
        /**
     * Méthode qui vérifie si un user existe en BDD avec son email
     * @param email string email de l'utilisateur
     * @return array retourne le tableau de l'utilisateur
     */
    function findUserByEmail(string $email,): array
    {
        try {
            
            $request = "SELECT u.id_users AS idUser, u.firstname, u.lastname, u.password, u.email FROM users AS u WHERE u.email = ?";
            
            $req = connectBDD()->prepare($request);
            
            $req->bindParam(1, $email, \PDO::PARAM_STR);
            
            $req->execute();
            return $req->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }