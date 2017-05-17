const commando = require('discord.js-commando');
const request = require('request-promise');


class fightCommand extends commando.Command {
    constructor(client) {
        super(client, {
            name: 'fight',
            group: 'champpi',
            memberName: 'fight',
            aliases: [
                'specials', 'attacks'
            ],
            description: 'Returns information about a champions attacks.',
            examples: ['!fight deadpool'],
            args: [{
                key: 'champName',
                prompt: 'Which champion do you want information on?\n\n',
                type: 'string'
            }]
        });
    }

    async run(msg, args) {
        const {
            champName
        } = args;
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/fight.php?c=' + champName,
            followAllRedirects: true,
            headers: {
                'User-Agent': `Commando`
            },
            json: true
        });
        const status = response.status;
        const name = response.name;
        const uppername = name.toUpperCase();
        const lowername = name.toLowerCase();
        const stripedname = lowername.replace(/(\-|\(|\)|\.|\s|\,)/g, "");

        const specials = response.specials;

        const img = response.img;


        const nameclass = response.heroclass_name;
        const colorname = response.color;
        const class_icon = response.heroclass_icon;

        const editspecials = specials.replace(/\[b\]/g, "\n");

        // https://www.w3schools.com/charsets/ref_utf_symbols.asp
        //⇪ = 21EA  ⇫	= 21EB  ◆ = 25C6  ◇ 25C7 

        const desc = '**Attack Info for: ' + uppername + '**' + editspecials + '\n\n*Reply "!info ' + stripedname + '" for more info*';
        if (status == 'success') {

            return msg.embed({
                description: desc,
                thumbnail: {
                    url: img
                },
                color: colorname,
                footer: {
                    icon_url: class_icon,
                    text: nameclass
                }
            });
        } else {
            return msg.say(':warning:   Champion not found. Please check the spelling and try again.');
        }
    }

}

module.exports = fightCommand;