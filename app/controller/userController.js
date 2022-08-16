const User = require('../modele/User');
const bcrypt = require('bcrypt');

const userController = {

    //Afficher la page login
    loginPage: async(request, response) => {
        try{
            if (request.session.user) {
                response.redirect('/home')
            }else{
                response.render('login')}
        }catch (error) {
                console.trace(error)
                return response.status(500).json(error.toString());
        } 
    },

    login: async (request, response) => {
        try {
             //On verifie si le membre est deja present en BDD via son email
             const user = await User.getMemberByEmail(request.body.email)
             if(request.body.email && request.body.password) { 
                 if (!user) {
                     response.json('Cette adresse email n\'existe pas');
                 }
                 if (user) {
                     const validePass = await bcrypt.compare(request.body.password, user.password);
                     if (!validePass){
                         response.json('le mot de passe est incorrect')
                     } else if(user.admin === true) { 
                         request.session.user = {
                             pseudo : user.pseudo,
                             email : user.email,
                             id : user.id,
                         } 
                         response.json({ pseudo : user.pseudo, email : user.email, id : user.id, });
                     } else {
                         response.json('Vous n\'etes pas autorisé a vous connectez.');
                     }
                 }   
             } else  {
                 response.json('Vous n\'avez pas saisi tout les champs')
             }
        }
        catch (error) {
            console.trace(error)
            return response.status(500).json(error.toString());
        }
    },
}

module.exports = userController;