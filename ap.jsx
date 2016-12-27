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
// а за пределами не действовали. или это не нужно? 


var data = $.getJSON('index.php', function (data) {

	
	var App = React.createClass({

		getInitialState: function(){
			return{
				data: null
			};
		},


		handleClick: function(){
			this.request = $.ajax({
				url: "process.php",
				// эти данные будут заполняться по клику на инпуты !!!!!!!!!!!!!!!!!!!!!!!!!!!!!
				data: 	{"qIndex": 2,
						"505": "start",
						"next": "next"
						},

				type: "POST",
				success: function (result){
					console.log(this);
					this.setState({data: result})
				}.bind(this)
			});
		},

		render: function(){
			return(
				// <div className='hidiv'>
			 //        <span className = 'hitext'>{this.props.hero.qText}</span>
				// </div>
			 //    <div className = 'middleScreen'>
			 //    	<div className = 'startButton-container'>
				//         <form action='process.php?qIndex={{question.qIndex}}' method='post'>
				//         	{% for key, variant in variantes %}
				//         		<input type = 'hidden' name ="{{key}}" id ="{{key}}" value ='{{variant["answer_text"]}}'>
				//         	{% endfor %}
				//         	<button name = "next" id = "next" type= "submit" value = "next" className = "startButton"> Начать </button>
				//         </form>
				//     </div>
			 //        <div className = 'pressEnterDiv'>
			 //            <span className = 'pressEnterText'> нажмите ENTER </span>
			 //        </div>
			 //    </div>



				<div>
					<p> {this.state.data} </p>
					<p> {this.props.hero.qNum} </p>
					<p> {this.props.hero.qIndex} </p>
					<p> {this.props.hero.qText} </p>
					<p> {this.props.hero.qComment} </p>
					<p> {this.props.hero.qView} </p>
					<button onClick = {this.handleClick}> Отправка </button>
				</div>
			)
		}
	})
	
	ReactDOM.render(<App hero = {data.question}/>, document.getElementById("root"));
	
});



