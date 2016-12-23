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

var Header = function (props){
	if (props.view == "start"){
		return(
			<div>
				Это старт
			</div>
		)
	} else {
		return(
			<div>
				Это второй экран
			</div>
		)
	}

}

var Page = React.createClass({

	getInitialState: function(){
		return{
			view: data['question']['qView']
		}
	},

	handleClick: function(){
		// вот тут будет отправка данных аяксом и получение нового объекта data
		this.setState({
			view: 2	
		});
	},

	render: function(){

		let headerHeight = {
			height: this.props.headerHeight
		}

		let contentStyle = {
			height: $('#root').height() - this.props.headerHeight * 2
		}

		let helloDivStyle = {
			height: ($('#root').height() - this.props.headerHeight * 2)/2 	
		}

		if (this.state.view == 'start'){
			return (
				<div className = 'page' > 
					<div className = 'header' style = {headerHeight}>
						<Header view = {this.state.view}/>
					</div>
					<div className = "content" style = {contentStyle}>
					// вот это нужно превратить в компонент
						<div className = "helloDiv" style = {helloDivStyle}>
							<div className = "helloText" > {this.props.qText} </div>
						</div>
						<div className = "helloButtons">
							<button name = "next" id = "next" type= "submit" value = "next"
								className = "startButton" onClick = {this.handleClick}> Начать </button>
							<div className = "pressEnterText">
								нажмите ENTER 
							</div>
						</div>
					</div>
					<div className = 'footer'>
					// сюда нужно вставить компонент
					</div>
				</div>
			)
		} else {
			return (
				<div className = 'page' >
					это второй вариант 
				</div>
			)
		}
	}
});

var App = React.createClass({
	render: function(){
		return(
			<Page qText = {this.props.heroes['question']['qText']} 
				  headerHeight = {70} />
		)
	}
})

ReactDOM.render(<App heroes = {data}/>, document.getElementById("root"));

});