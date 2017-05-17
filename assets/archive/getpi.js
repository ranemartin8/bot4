const commando = require('discord.js-commando');
const request = require('request-promise');


class PICommand extends commando.Command {
    constructor(client) {
        super(client, {
            name: 'pi',
            group: 'champpi',
            memberName: 'pi',
            description: 'Returns the PI of champion at a certain Dupe/SigLevel (Options: 0/20/40/60/80/99)',
            examples: [';pi cable 20'],
            args: [{
                key: 'champName',
                prompt: 'Which champion do you want the PI of?',
                type: 'string'
            },
            {
                key: 'levelValue',
                prompt: 'What dupe/sig level do you want? (Options: 0/20/40/60/80/99)',
                type: 'integer',
                default: '99'

                }]
        });   
    }

	async run(msg, args) {
		const { champName, levelValue } = args;
		const response = await request({
			method: 'GET',
			uri: 'https://assgardians.000webhostapp.com/mcoc_db/champ_pi.php?c=' + champName + '&l=' + levelValue,
			followAllRedirects: true,
			headers: { 'User-Agent': `Commando` },
			json: true
		});

        const value = response.value;
        const level = response.level;

        const nameClean = response.name;
        const img = response.img;
        const classname = response.classname;
        const icon = response.class_icon;
        const colorname = response.color;

        return msg.embed({
            title : 'PI for ' + nameClean,
            description : "Value at Level " + level + ': **' + value + '**',
            thumbnail: { url: img },
            color : colorname,
            footer: {
              icon_url: icon,
                 text: classname
            }
        });

	}

}

module.exports = PICommand;
