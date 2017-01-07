// в реакт для работы с событиями используются свойства, 
// т.е. можно определить свойство onClick для кнопки видимо

// свойства, которые передаются компоненту нельзя изменить, т.е. компоненты не могут изменить те данные, 
// которые им отправляются

// состояние - такая штука у компонента, при изменении которой реакт сам обновит ДОМ - 
// это как раз то, что мне нужно! 

// у простых компонентов не бывает состояния - это функциональные компоненты, задаются как функция
// состояния бывают у сложных компонентов, которые задаются как объекты (используется метод createClass)


var data = $.getJSON('index.php', function (data) {
	

	var Variantes = function (props) {
		return (
			<div> 
			{Object.keys(props.data).map(function(key){ 
				return  <div key = {key} > 
							<p> {props.data[key].answerIndex} </p>
							<p> {props.data[key].answer_text} </p>
							<input type = "text"/>
						</div>
			})}
			</div>
		)
	};

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
		}

		render () {
			var a = "start";
			let ContentCondition = null;
			if (this.state.data.question.qView == 'start'){				
				ContentCondition = 
					<div className = 'content'>			
					    <div className='hidiv'>
					       	<span className = 'hitext'> {this.state.data.question.qText} </span>
						</div>
					    <div className = 'middleScreen'>
					    	<div className = 'startButton-container'>
								<form action='' method='post'>
						        	<button name = "next" id = "next" type= "submit" value = "next" className = "startButton"> Начать </button>
						        </form>					    
						    </div>
					        <div className = 'pressEnterDiv'>
					            <span className = 'pressEnterText'> нажмите ENTER </span>
					        </div>
					    </div>
					</div>;
			} else {
				ContentCondition = 
					<div className = 'content'>
						<p> {this.state.data.question.qView} </p>
						<p> {this.state.data.question.id_test} </p>
						<p> {this.state.data.question.qNum} </p>
						<p> {this.state.data.question.qIndex} </p>
						<p> {this.state.data.question.qText} </p>
						<p> {this.state.аdata.question.qComment} </p>
						<Variantes data = {this.state.data.variantes}/> 					
					</div>;
			}

			return(
				<div>
					<div className = "header">
					</div>
					{ContentCondition}
					<div className = 'buttons'>
						<button onClick = {this.handleClick.bind(this)} > Отправить </button>
					</div>
					
					<div className = "footer">
					</div>
				</div>
			)
		}
	}

	ReactDOM.render(<App hero = {data} />, document.getElementById("root"));
});