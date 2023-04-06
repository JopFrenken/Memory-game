import axios from "axios"


export default {
    // sends game data to backend to store in db
    sendGameData: function (name, clicks, time) {
        let obj = {name: name, clicks: clicks, time: time}
        return axios.post('https://87734.hosting.ict-college.net/Memory-game/api/score', obj)
    },

    getScores: function () {
        return axios.get('https://87734.hosting.ict-college.net/Memory-game/api/score');
    }
}