import React, { Component } from 'react'
import ControlPanel from './../../ControlPanel'
import DisplayPanel from './../../DisplayPanel'
import './index.css'

class Main extends Component {

  render() {
    return (
      <main className="container-fluid content-wrapper">
        <div className="container" role="main">
          <ControlPanel />
          <hr/>
          <DisplayPanel />
        </div>
      </main>
    )
  }
}

export default Main
