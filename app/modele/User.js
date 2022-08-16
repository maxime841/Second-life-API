const db = require('../database');

const User = {

    getMemberByEmail: async (email) => {
        const userViaMail = await db.query(`SELECT * FROM staff WHERE email = $1;`, [email]);
        return userViaMail.rows[0];
    },
}

module.exports = User;