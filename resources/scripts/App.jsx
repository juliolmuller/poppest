import React, { Component } from 'react'
import Header from './components/layout/Header'
import Main from './components/layout/Main'

export default class App extends Component {

  render() {
    return (
      <React.Fragment>
        <Header />
        <Main />
      </React.Fragment>
    )
  }
}
