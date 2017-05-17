const commando = require('discord.js-commando');
const request = require('request-promise');

class aqmilestonerewardsCommand extends commando.Command {
constructor(client) {
        super(client, {
            name: 'aqmilestonerewards',
            aliases: [
                'aq-milestonerewards',
                'milestonerewards',
                'milestonereward',
                'aqmilestonereward',
                'aq_milestonerewards'
            ],
            group: 'content',
            memberName: 'aqmilestonerewards',
            description: 'Returns AQ Milestone Rewards',
            examples: ['!aqmilestonerewards'],
        });   
    }
    async run(msg) {
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=aqmilestonerewards',
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });
        return msg.say(response);
    }
}
module.exports = aqmilestonerewardsCommand;
