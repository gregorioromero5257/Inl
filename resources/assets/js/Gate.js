export default class Gate{

    constructor(user){
        this.user = user;
    }


    isDirector(){
        return this.user.type === 'director';
    }

    isFortisDirector(){
        return this.user.type === 'fortis_director';
    }

    isCoordinator(){
        return this.user.type === 'coordinator';
    }

    isAnalyst(){
        return this.user.type === 'analyst';
    }

    isINL(){
        return this.user.type === 'inl';
    }
}
