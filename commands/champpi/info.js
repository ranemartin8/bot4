const commando = require('discord.js-commando');
const request = require('request-promise');


class UTCommand extends commando.Command {
    constructor(client) {
        super(client, {
            name: 'ab',
            group: 'champpi',
            memberName: 'ab',
            aliases: [
                'ut', 'info'
            ],
            description: 'Returns information about a champion (abilities, game tags, Seatin rank, etc).',
            examples: ['!ab deadpool'],
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
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/info.php?c=' + champName,
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

        const offense = response.seatin_o;
        const defense = response.seatin_d;

        const ab = response.ability_string;
        const tag = response.tag_string;
        const img = response.img;
        const url = response.url_1;
        const video = response.video;

        const nameclass = response.heroclass_name;
        const colorname = response.color;
        const class_icon = response.heroclass_icon;

        const editAb = ab.replace(/\(a\)/g, "\u25C6");
        const newAb = editAb.replace(/\(e\)/g, "\u25C7");
        // https://www.w3schools.com/charsets/ref_utf_symbols.asp
        //⇪ = 21EA  ⇫	= 21EB  ◆ = 25C6  ◇ 25C7 

        const desc = '**' + uppername + '**\n\n**Abilities:** ' + newAb + '\n\n**Tags:** ' + tag + '\n\n**Seatin Rank:** ' + 'Offense - ' + offense + ' • Defense - ' + defense + '\n\n**Special Moves:** ' + video + '\n\n**Learn More:** ' + url + '\n\n*Reply "!stats ' + stripedname + '" for stats or "!syn ' + stripedname + '" for synergies*';
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

module.exports = UTCommand;