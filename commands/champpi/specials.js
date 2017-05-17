const commando = require('discord.js-commando');
const request = require('request-promise');


class SpecialCommands extends commando.Command {
    constructor(client) {
        super(client, {
            name: 'sp',
            group: 'champpi',
            memberName: 'sp',
            description: 'Returns a champions attacks and specials.',
            examples: ['!sp captainamerica'],
            args: [{
                key: 'champname',
                prompt: 'Provide champ name\n\n',
                type: 'string'
            }]
        });   
    }
	async run(msg, args) {

        return msg.embed({
            description : '**ABOMINATION**\n\n**Skull Bash:**',
            thumbnail: { url: './assets/img/img_100.png' },
            color : 6989903 ,
            footer: {
              icon_url: 'https://assgardians.000webhostapp.com/mcoc_db/imgs/class_icons/science.png',
                 text: 'science'
            }

        });

	}

}

module.exports = SpecialCommands;
