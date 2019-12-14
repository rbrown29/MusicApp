import React from 'react';
import Header from './components/Header'
import Main from './components/Main'
import music from './data.js'

class App extends React.Component{
  constructor(props){
    super(props)
    this.state = {
      music:music,
      }
    }

    render(){
      return(
        <>
          <Header />
          <Main music={this.state.music}/>
        </>
      )
    }
  }
export default App;
