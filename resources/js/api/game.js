import axios from "axios"

export default {
    // sends game data to backend to store in db
    sendGameData: function (name, clicks, time) {
        let obj = {name: name, clicks: clicks, time: time}
        return axios.post('Memory-game/api/score', obj)
    },

    getScores: function () {
        return axios.get('Memory-game/api/score');
    }
}