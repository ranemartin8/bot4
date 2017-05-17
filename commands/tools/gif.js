
const { Command } = require('discord.js-commando');
const superagent = require('superagent');


module.exports = class GiphySearchCommand extends Command {
	constructor(client) {
		super(client, {
			name: 'gif',
			group: 'tools',
			memberName: 'gif',
			description: 'Search for gifs through Giphy',
			examples: ['!gif lucario'],
			//throttling: {
			//	usages: 2,
			//	duration: 5
			//},
			args: [
				{
					key: 'query',
					prompt: 'What would you like to search?\n',
					type: 'string'
				}
			]
		});
	}

	async run(msg, args) {
		const link = `http://api.giphy.com/v1/gifs/search?q=${args.query.split(' ').join('+')}&api_key=dc6zaTOxFJmzC&limit=1&rating=g`;

		superagent.get(link)
			.then(res => {
                 msg.delete();
				return msg.say(res.body.data[Math.floor(Math.random() * res.body.data.length)].images.original.url).catch(() => msg.reply('there were no results.'));
			})
			.catch(err => {
				msg.say('There was an error, please try again later.');
				return console.error(err);
			});
	}
};