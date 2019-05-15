const ID_LENGTH = 4;
const PIN_LENGTH = 3;

const ATM = {
    isAuth: false,
    currentUser: {},
    // all cash available in ATM
    cash: 2000,
    // all available users
    users: [
        { id: "0000", pin: "000", debet: 0, type: "admin" }, // EXTENDED
        { id: "0025", pin: "123", debet: 675, type: "user" }
    ],
    // authorization
    auth(id, pin) {
        id = id.toString();
        pin = pin.toString();
        if (id.length !== ID_LENGTH || pin.length !== PIN_LENGTH ){
            console.log('not correct data entered');
            return;
        }
        if (this.isAuth) {
            console.log('some user is login now, need to logOut at first');
            return;
        }
        let isWrongPin = false;
        this.users.some(currUser => {
            if (currUser.id === id && currUser.pin === pin){
                this.currentUser = currUser;
                this.isAuth = true;
                console.log(`user ${id} now login`);
                return true;
            }

            if (currUser.id === id && currUser.pin !== pin ) {
                isWrongPin = true;
            }
            return false;
        });

        //id exist but pin not equals
        if (!this.isAuth && isWrongPin){
            console.log('not correct user data input');
            return;
        }

        if (!this.isAuth && !isWrongPin) {
            this.users.push({id: id, pin: pin, debet: 0, type: "user"});
            console.log('new user now is registered & still need authorisation');
            return;
        }
 
    },
    // check current debet
    check() {
        if (!this.isAuth){
            console.log('no user login ');
            return;
        }
        console.log(`user ${this.currentUser.id} have ${this.currentUser.debet}`);

    },
    // get cash - available for user only
    getCash(amount) {
        if (!this.isAuth){
            console.log('no user login ');
            return;
        }
        if (this.currentUser.debet >= amount){
            this.currentUser.debet -= amount;
            console.log('take your money');
            return;
        }
        console.log('not enough debet');
        return;
    },
    // load cash - available for user only
    loadCash(amount) {
        if (!this.isAuth){
            console.log('no user login ');
            return;
        }

        this.currentUser.debet += amount;
        console.log('ok');
        return;
    },
    // load cash to ATM - available for admin only - EXTENDED
    loadAtmCash(amount) {
 
    },
    // get cash actions logs - available for admin only - EXTENDED
    getLogs() {
 
    },
    // log out
    logout() {
        if (!this.isAuth){
            console.log('no user login');
            return;
        }
        this.isAuth = false;
        console.log(`user ${this.currentUser.id} now logOut`);
    }
};
