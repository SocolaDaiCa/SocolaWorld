class User {
	constructor(id, name) {
		this.rank = 27;
		this.id = id;
		this.name = name;
		this.posts = 0;
		this.comments = { in: 0, out: 0 };
		this.reactions = { in: 0, out: 0 };
		this.detailReactions = { LIKE: 0, LOVE: 0, HAHA: 0, WOW: 0, SAD: 0, ANGRY: 0 };
		this.score = 0;
	}
	commentIn() {
		this.comments.in++;
	}
	commentOut() {
		this.comments.out++;
	}
	reactionIn(type) {
		this.reactions.in++;
		this.detailReactions[type]++;
	}
	reactionOut(type) {
		this.reactions.out++;
		this.detailReactions[type]++;
	}
	postOut() {
		this.posts++;
	}
	calculateScore(score) {
		this.score = 0 +
			this.posts * score.post +
			this.comments.in * score.comment +
			this.comments.out * score.comment +
			this.detailReactions.LIKE * score.like +
			this.detailReactions.LOVE * score.love +
			this.detailReactions.HAHA * score.haha +
			this.detailReactions.WOW * score.wow +
			this.detailReactions.SAD * score.sad +
			this.detailReactions.ANGRY * score.angry;
	}
	getPost() {
		return this.post;
	}
	getCommentOut() {
		return this.comments.out;
	}
	getCommentsIn() {
		return this.comments.in;
	}
	getReactionsOut() {
		return this.reactions.out;
	}
	getReactionsIn() {
		return this.reactions.in;
	}
};
class Users{
	constructor(){
		this.users = new Map();
		this.count = 0;
	}
	reset(){
		this.users = new Map();
		this.count = 0;
	}
	add({id, name}){
		!this.users.has(id) && (this.users.set(id, new User(id, name)) + this.count++);
	}
	comment(ownCmt, ownPost){
		this.users.has(ownCmt) && this.users.get(ownCmt).commentOut();
		this.users.has(ownPost) && this.users.get(ownPost).commentIn();
		app.count.comments++;
	}
	post(ownPost){
		this.users.has(ownPost) && this.users.get(ownPost).postOut();
		app.count.posts++;
	}
	reaction(ownReaction, ownPostOrCmt, type){
		this.users.has(ownReaction) && this.users.get(ownReaction).reactionOut(type);
		this.users.has(ownPostOrCmt) && this.users.get(ownPostOrCmt).reactionIn(type);
		app.count.reactions++;
	}
}