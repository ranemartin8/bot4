const commando = require('discord.js-commando');
const sql = require('sqlite');
sql.open('../../guildInfo.sqlite3');

class delTagCommand extends commando.Command {
    constructor(client) {
        super(client, {
            name: 'deltag',
            group: 'tags',
            memberName: 'deltag',
            description: 'Deletes a tag command from database',
            examples: ['deltag [tag name]'],
            args: [{
                key: 'name',
                prompt: 'What is the name of the tag to remove?\n',
                type: 'string'
            }],
            guildOnly: true
        })
    }
  //  hasPermission(msg) {
  //     return this.client.isOwner(msg.author) || msg.member.permissions.has('KICK_MEMBERS');
 //   }
    async run(message, args) {
        const { name } = args
        let nameLower = name.toLowerCase()

        sql.get(`DELETE FROM serverTags WHERE guildID = ${message.member.guild.id} AND name = '${nameLower}'`).then(row => {
            if (!row) return message.channel.send(':skull_crossbones: Tag command removed. Dead. Gone. You killed it. You *monster!* ')

        })
    }
}

module.exports = delTagCommand;