require('dotenv').config();
const express = require('express');
const cors = require('cors')

const app = express();
const port = process.env.PORT || 7070;
const router = require('./router');

// CORS
app.use((req, res, next) => {

	// on autorise explicitement le domaine du front
	const allowedOrigins = ['http://localhost:8080'];
	const { origin } = req.headers;
	if (allowedOrigins.includes(origin)) {
	  	res.setHeader('Access-Control-Allow-Origin', "*", req.headers.origin, origin);
		res.setHeader("Access-Control-Allow-Headers", "Authorization, Cache-Control, Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
	}
	// on autorise le partage du cookie
	res.header('Access-Control-Allow-Credentials', true);
	// on autorise le partage de ressources entre origines
	res.header('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept', "*");
	res.header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');
  
	next();
});

app.use(express.json());

app.use(router);

app.init = () => {
    app.listen(port, () => console.log(`Running on http://localhost:${port}`));
};

module.exports = app;