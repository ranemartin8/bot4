const commando = require('discord.js-commando');
const request = require('request-promise');

class arenastreak extends commando.Command {
constructor(client) {
        super(client, {
            name: 'arenastreak',
            aliases: [
                'arena-streak',
                'infinitestreak',
                'arenastreaks',
                'streak'
            ],
            group: 'content',
            memberName: 'arenastreak',
            description: 'Returns a guide to infinite streaks in the arena.',
            examples: ['!arenastreak'],
        });   
    }
    async run(msg) {
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=arenastreak',
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });
        return msg.say(response);
    }
}
module.exports = arenastreak;
