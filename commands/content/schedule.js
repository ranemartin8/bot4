const commando = require('discord.js-commando');
const request = require('request-promise');

class Schedule extends commando.Command {
constructor(client) {
        super(client, {
            name: 'schedule',
            aliases: [
                'sched',
                'dates',
                'cal'
            ],
            group: 'content',
            memberName: 'schedule',
            description: 'Returns schedule',
            examples: ['!schedule'],
        });   
    }
    async run(msg) {
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=schedule',
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });
        return msg.say(response);
    }
}
module.exports = Schedule;
