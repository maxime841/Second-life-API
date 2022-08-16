const { Router } = require('express');

const homeController = require('./controller/homeController');
const landController = require('./controller/landController');
const djControllers = require('./controller/djController');
const dancerController = require('./controller/dancerController');
const houseController = require('./controller/houseController');
const partyController = require('./controller/partyController');
const tenantController = require('./controller/tenantController');
const userController = require('./controller/userController');

const router = Router();

/*******************************Route Home *********************************************/
router.get('/v1/home', homeController.home)

/********************************Route login / Signin ********************************/
router.get('/v1/login', userController.loginPage)

module.exports = router;