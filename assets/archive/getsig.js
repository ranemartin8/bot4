const commando = require('discord.js-commando');
const request = require('request-promise');


class SigCommand extends commando.Command {
    constructor(client) {
        super(client, {
            name: 'sig',
            group: 'champpi',
            memberName: 'sig',
            description: 'Returns the Signature Ablity values of champion at a certain Dupe/SigLevel (Options: 0/20/40/60/80/99)',
            examples: ['!sig beast 20'],
            args: [{
                key: 'champName',
                prompt: 'Which champion do you want the Sig ability of?\n',
                type: 'string'
            },
            {
                key: 'levelValue',
                prompt: 'What Dupe/sig level? (Options: 0/20/40/60/80/99/desc)\n',
                type: 'string',
                default: '99'

                }]
        });   
    }

	async run(msg, args) {
		const { champName, levelValue } = args;
		const response = await request({
			method: 'GET',
			uri: 'https://assgardians.000webhostapp.com/mcoc_db/sig.php?c=' + champName + '&l=' + levelValue,
			followAllRedirects: true,
			headers: { 'User-Agent': `Commando` },
			json: true
		});
        const value = response.value;
        const desc = response.desc;
        const level = response.level;

        const nameClean = response.name;
        const img = response.img;
        const classname = response.classname;
        const icon = response.class_icon;
        const colorname = response.color;

        return msg.embed({
            title : 'Signature Ability for ' + nameClean,
            description : "Value at Level " + level + ': **' + value + '**\n\n' + "Description: " + '\n' + desc,
            thumbnail: { url: img },
            color : colorname,
            footer: {
              icon_url: icon,
                 text: classname
            }
        });
	}

}

module.exports = SigCommand;
