const commando = require('discord.js-commando');
const request = require('request-promise');
const RichEmbed = require('discord.js');



class SeatinCommand extends commando.Command {
    constructor(client) {
        super(client, {
            name: 'seatin',
            group: 'champpi',
            memberName: 'seatin',
            description: 'Returns the Seatin rank of a champion.',
            examples: ['?seatin deadpool'],
            args: [{
                key: 'champName',
                prompt: 'Which champion do you want the Seatin rank of?\n\n',
                type: 'string'
            }]
        });   
    }



	async run(msg, args) {
		const { champName } = args;

		const response = await request({
			method: 'GET',
			uri: 'https://assgardians.000webhostapp.com/mcoc_db/info.php?c=' + champName,
			followAllRedirects: true,
			headers: { 'User-Agent': `Commando` },
			json: true
		});
        const status = response.status;
        const offense = response.seatin_o;
        const defense = response.seatin_d;
        
        const nameClean = response.name;
        const uppername = nameClean.toUpperCase();
        const img = response.img;
        const classname = response.heroclass_name;
        const icon = response.heroclass_icon;
        const colorname = response.color;

if (status == 'success') {
        return msg.embed({
        description : '**Seatin Rankings for: ' + uppername + "**\n\nOffense: " + offense + '\n' + "Defense: " + defense,
        thumbnail: { url: img },
        color : colorname,
        footer : {
          icon_url: icon,
          text: classname
            }

        });
} else {
            return msg.say(':warning:   Champion not found. Please check the spelling and try again.');
        }

	}

}

module.exports = SeatinCommand;
