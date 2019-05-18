const ID_LENGTH = 4;
const PIN_LENGTH = 3;


const ATM = {
    logs: [],
    isAuth: false,
    currentUser: {},
    // all cash available in ATM
    cash: 2000,
    // all available users
    users: [
        {id: "0000", pin: "000", debet: 0, type: "admin"}, // EXTENDED
        {id: "0025", pin: "123", debet: 675, type: "user"}
    ],
    // authorization
    auth(id, pin) {
        id = id.toString();
        pin = pin.toString();
        if (id.length !== ID_LENGTH || pin.length !== PIN_LENGTH) {
            this.logs.push({
                id: this.currentUser.id,
                AtmCash: this.cash,
                action: 'auth',
                res: 'not correct data entered'
            });
            console.log('not correct data entered');
            return;
        }
        if (this.isAuth) {
            this.logs.push({
                id: id,
                AtmCash: this.cash,
                action: 'auth',
                res: ` ${this.currentUser.id} is login now, need to logOut at first`
            });
            console.log('some user is login now, need to logOut at first');
            return;
        }
        let isWrongPin = false;
        this.users.some(currUser => {
            if (currUser.id === id && currUser.pin === pin) {
                this.currentUser = currUser;
                this.isAuth = true;
                this.logs.push({
                    id : id,
                    AtmCash: this.cash,
                    action: 'auth',
                    res: `user ${id} now login`
                });
                console.log(`user ${id} now login`);
                return true;
            }

            if (currUser.id === id && currUser.pin !== pin) {
                isWrongPin = true;
            }
            return false;
        });

        //id exist but pin not equals
        if (!this.isAuth && isWrongPin) {
            this.logs.push({
                id : id,
                AtmCash: this.cash,
                action: 'auth',
                res: 'not correct user data input'
            });
            console.log('not correct user data input');
            return;
        }

        if (!this.isAuth && !isWrongPin) {
            this.users.push({id: id, pin: pin, debet: 0, type: "user"});
            this.logs.push({
                id : id,
                AtmCash: this.cash,
                action: 'auth',
                res: 'new user now is registered & still need authorisation'
            });
            console.log('new user now is registered & still need authorisation');
            return;
        }

    },
    // check current debet
    check() {
        if (!this.isAuth) {
            this.logs.push({
                id: this.currentUser.id,
                AtmCash: this.cash,
                action: 'check',
                res: 'no user login'
            });
            console.log('no user login ');
            return;
        }

        if (this.currentUser.type === 'admin') {
            this.logs.push({
                id: this.currentUser.id,
                AtmCash: this.cash,
                action: 'check ATM cash',
                res: 'check ATM cash'
            });
            console.log(`ATM cash is ${this.cash}`);
            return;
        }

        this.logs.push({
            id: this.currentUser.id,
            AtmCash: this.cash,
            action: 'check',
            res: `user ${this.currentUser.id} have ${this.currentUser.debet}`
        });
        console.log(`user ${this.currentUser.id} have ${this.currentUser.debet}`);

    },
    // get cash - available for user only
    getCash(amount) {
        if (!this.isAuth || this.currentUser.type === 'admin') {
            this.logs.push({
                id: this.currentUser.id,
                AtmCash: this.cash,
                action: 'getCash',
                res: 'no user login'
            });
            console.log('no user login ');
            return;
        }
        if (this.currentUser.debet >= amount && this.cash >= amount) {
            this.currentUser.debet -= amount;
            this.cash -= amount;
            this.logs.push({
                id: this.currentUser.id,
                AtmCash: this.cash,
                action: 'getCash',
                res: `get ${amount}`
            });
            console.log('take your money');
            return;
        }
        if (this.cash < amount) {
            this.logs.push({
                id: this.currentUser.id,
                AtmCash: this.cash,
                action: 'getCash',
                res: 'not enough cash in ATM'
            });
            console.log('not enough cash in ATM');
            return;
        }
        this.logs.push({
            id: this.currentUser.id,
            AtmCash: this.cash,
            action: 'getCash',
            res: 'not enough debet'
        });
        console.log('not enough debet');
    },
    // load cash - available for user only
    loadCash(amount) {
        if (!this.isAuth || this.currentUser.type === 'admin') {
            this.logs.push({
                id: this.currentUser.id,
                AtmCash: this.cash,
                action: 'loadCash',
                res: 'no user login'
            });
            console.log('no user login');
            return;
        }

        this.currentUser.debet += amount;
        this.cash += amount;
        this.logs.push({
            id: this.currentUser.id,
            AtmCash: this.cash,
            action: 'loadCash',
            res: `load ${amount}`
        });
        console.log('ok');
        return;
    },
    // load cash to ATM - available for admin only - EXTENDED
    loadAtmCash(amount) {

        if (this.currentUser.type !== 'admin') {
            this.logs.push({
                id: this.currentUser.id,
                AtmCash: this.cash,
                action: 'loadAtmCash',
                res: 'access denied'
            });
            console.log('access denied');
            return;
        }

        this.cash += amount;
        this.logs.push({
            id: this.currentUser.id,
            AtmCash: this.cash,
            action: 'loadAtmCash',
            res: `load ${amount}`
        });
        console.log(`load ${amount}`);


    },
    // get cash actions logs - available for admin only - EXTENDED
    getLogs() {
        if (this.currentUser.type !== 'admin') {
            this.logs.push({
                id: this.currentUser.id,
                AtmCash: this.cash,
                action: 'getLogs',
                res: 'access denied'
            });
            console.log('access denied');
            return;
        }
        this.logs.push({
            id: this.currentUser.id,
            AtmCash: this.cash,
            action: 'getLogs',
            res: `logs length is ${this.logs.length}`
        });
        this.logs.forEach(currLog => {
            for (let field in currLog){
                console.log(`${field} is ${currLog[field]}`);
            }
            console.log('--------------');
        })
    },
    // log out
    logout() {
        if (!this.isAuth) {
            this.logs.push({
                id: this.currentUser.id,
                AtmCash: this.cash,
                action: 'logOut',
                res: 'no user login'
            });
            console.log('no user login');
            return;
        }
        this.isAuth = false;
        const tempUser = this.currentUser;
        this.currentUser = {};
        this.logs.push({
            id: tempUser.id,
            AtmCash: this.cash,
            action: 'logOut',
            res: `user ${tempUser.id} now logOut`
        });

        console.log(`user ${tempUser.id} now logOut`);
    }
};
