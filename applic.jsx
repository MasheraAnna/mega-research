// в реакт для работы с событиями используются свойства, 
// т.е. можно определить свойство onClick для кнопки видимо

// свойства, которые передаются компоненту нельзя изменить, т.е. компоненты не могут изменить те данные, 
// которые им отправляются

// состояние - такая штука у компонента, при изменении которой реакт сам обновит ДОМ - 
// это как раз то, что мне нужно! 

// у простых компонентов не бывает состояния - это функциональные компоненты, задаются как функция
// состояния бывают у сложных компонентов, которые задаются как объекты (используется метод createClass)




// я не понимаю структуру данных здесь.
// если сделать console.log(this) внутри headerHeight, то this окажется data со свойством url: index.html
// почему? почему не StartPage
// а если сделать console.log(this) внутри render, то this будет уже StartPage - почему?
// главный вопрос: как задавать стили, чтобы они были свойствами объекта, и передавались в него, 
// а за пределами не дейтвовали. или это не нужно? 




var data = $.getJSON('index.php', function (data) {

	var App = React.createClass({
		getInitialState: function(){
			return{
				data:null
			};
		},

	// вот что тут происходит с этим this я тоже не понимаю совсем.
		handleClick: function(){
			this.request = $.ajax({
				url: "index.php",
				data: {qId: 1},
				type: "GET",
				success: function (result){
					console.log(this);
					this.setState({data: result})
				}.bind(this)
			});
		},
		render: function(){
			return(
				<div>
					<p> при нажатии на кнопку отправлять запрос в index.php и получать оттуда обновленные данные </p>
					<p> должна обязательно произойти отправка данных на сервер и установка id респонденту, тогда
					можно будет дальше пойти, т.к. question принимает респ-ид как обязательное условие </p>
					
					<p> {this.state.data} </p>
					<p> {this.props.data['question']} </p>
					<p> {this.props.data['question']} </p>
					<button onClick = {this.handleClick}> Отправка </button>
				</div>
			)
		}
	})
	
	ReactDOM.render(<App data = {data}/>, document.getElementById("root"));
	
});