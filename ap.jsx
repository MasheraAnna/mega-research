// в реакт для работы с событиями используются свойства, 
// т.е. можно определить свойство onClick для кнопки видимо

// свойства, которые передаются компоненту нельзя изменить, т.е. компоненты не могут изменить те данные, 
// которые им отправляются

// состояние - такая штука у компонента, при изменении которой реакт сам обновит ДОМ - 
// это как раз то, что мне нужно! 

// у простых компонентов не бывает состояния - это функциональные компоненты, задаются как функция
// состояния бывают у сложных компонентов, которые задаются как объекты (используется метод createClass)



var data = $.getJSON('index.php', function (data) {
	console.log(typeof(data));
	class App extends React.Component {
		
		constructor(props){
			super(props);
			this.state = {data: props.hero }
		}
	
		handleClick () {
			this.request = $.ajax({
				url: "process.php",
	// эти данные будут заполняться по клику на инпуты!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
				data: 	{"qIndex": 1,
						"505": "start",
						"next": "next"
						},

				type: "POST",
				success: function(result){
					var resultObject = JSON.parse(result)
					this.setState({data: resultObject})
				}.bind(this)
			});
			console.log(this.state.data);
		}
		render () {
			return(
				<div>
					<div className = "header">
					</div>
					<div className='content'>
						<p> {this.state.data.question.id_test} </p>
						<p> {this.state.data.question.qNum} </p>
						<p> {this.state.data.question.qIndex} </p>
						<p> {this.state.data.question.qText} </p>
						<p> {this.state.data.question.qComment} </p>
						<button onClick = {this.handleClick.bind(this)}> Отправка </button>
					</div>
					<div className = "footer">
					</div>				
				</div>
			)
		}
	
	}
	ReactDOM.render(<App hero = {data} />, document.getElementById("root"));
});