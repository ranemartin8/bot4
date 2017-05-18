const commando = require('discord.js-commando');
const { stripIndents } = require('common-tags');
const sql = require('sqlite');
sql.open('../../guildInfo.sqlite3');

class tagCommand extends commando.Command {
    constructor(client) {
        super(client, {
            name: 't',
            group: 'tags',
            memberName: 't',
            description: 'Calls a custom tag command.',
            examples: ['tag [tag name]'],
            guildOnly: true,
            args: [{
                key: "name",
                prompt: 'What is the name of the command?\n',
                type: 'string'
            }],
            throttling: {
                usages: 2,
                duration: 5
            }
        })
    }
    
    async run(message, args) {
        const { name } = args;
        let nameLower = name.toLowerCase();

        sql.get(`SELECT * FROM serverTags WHERE guildID = ${message.member.guild.id} AND name = '${nameLower}'`).then(row => {
            if (!row) return message.channel.send(':x: That tag or name could not be found. Do better next time. Reply .list for a list of commands')

            message.channel.send(`${row.tag}`)
        })
    }
}

module.exports = tagCommand;