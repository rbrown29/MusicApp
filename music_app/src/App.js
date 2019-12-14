import React from 'react';
import Header from './components/Header'
import Nav from './components/Nav'
import Side from './components/Side'
import Songs from './components/Songs'

class App extends React.Component{
  constructor(props){
    super(props)
    this.state = {

    }
  }

  render(){
    return(
      <>
      <Header />
      <Nav />
      <Side />
      <Songs />

      </>
    )
  }
}

export default App;
