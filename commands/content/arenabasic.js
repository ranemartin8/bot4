const commando = require('discord.js-commando');
const request = require('request-promise');

class arenabasicCommand extends commando.Command {
constructor(client) {
        super(client, {
            name: 'arenabasic',
            aliases: [
                'basic',
                'basiccal',
                'basicarena',
                'basicchamps'
            ],
            group: 'content',
            memberName: 'arenabasic',
            description: 'Returns Upcoming Basic Arena Champs',
            examples: ['!arenabasic'],
        });   
    }
    async run(msg) {
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=arenabasic',
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });
        return msg.say(response);
    }
}
module.exports = arenabasicCommand;
