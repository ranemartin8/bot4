const commando = require('discord.js-commando');
const request = require('request-promise');


class TimeCommand extends commando.Command {
    constructor(client) {
        super(client, {
            name: 'time',
            group: 'tools',
            memberName: 'time',
            description: 'Get the local times of all the members of a battle group. Ex: **!time bg1** or **!time all**',
            examples: ['!time bg1'],
            args: [{
                key: 'group',
                prompt: 'Which battlegroup do you want the local times for?\n\n Ex: **!time bg1** or **!time all**\n\n',
                type: 'string',
                default: 'all'
            }]
        });   
    }

	async run(msg, args) {
		const { group } = args;
        const upper = group.toUpperCase();
		const response = await request({
			method: 'GET',
			uri: 'https://assgardians.000webhostapp.com/mcoc_db/time.php?bg=' + group,
			followAllRedirects: true,
			headers: { 'User-Agent': `Commando` },
			json: true
		});



        return msg.embed({
         //   title : ':alarm_clock:   Local Times for ' + upper + ' Members\n\n',
          //  description : '\n' + ' ' + '\n' + response,
            description : ':alarm_clock:     **Local Times for ' + upper + ' Members**\n' + response,
            color : 0x4ac5a3
            
        });

	}

}

module.exports = TimeCommand;
