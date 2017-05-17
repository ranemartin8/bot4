const commando = require('discord.js-commando');
const request = require('request-promise');


class ABCommand extends commando.Command {
    constructor(client) {
        super(client, {
            name: 's',
            group: 'champpi',
            memberName: 's',
            aliases: [
                'search', 'lookup'
            ],
            description: 'Returns champions based on ability search keyword.',
            examples: ['!s bleed'],
            args: [{
                key: 'keyword',
                prompt: 'Provide a search keyword. Ex: Bleed, Cosmic, Power\n\n',
                type: 'string'
            }]
        });   
    }

	async run(msg, args) {
		const { keyword } = args;
		const response = await request({
			method: 'GET',
			uri: 'https://assgardians.000webhostapp.com/mcoc_db/search.php?c=' + keyword,
			followAllRedirects: true,
			headers: { 'User-Agent': `Commando` },
			json: true
		});
    const upperkey = keyword.toUpperCase();


var searchMask = "<br>";
var regEx = new RegExp(searchMask, "ig");
var replaceMask = "\n";

var editresp = response.replace(regEx, replaceMask);

        return msg.embed({
            
            description : '**Search Results for: ' + upperkey + '**\n\n' + editresp,
            color : 0x4ac5a3
        });
	}

}

module.exports = ABCommand;
