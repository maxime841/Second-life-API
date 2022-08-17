const homeController = {
    home: async (request, response) => {
        try{
            //if(request.session.user){
                response.render('home');
            //}
        }
        catch(error){
            console.trace(error)
            return response.status(500).json(error.toString());
        }
    }
}

module.exports = homeController;