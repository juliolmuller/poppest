import React, { Component } from 'react'
import ControlPanel from './ControlPanel'
import DisplayPanel from './DisplayPanel'

class ContentController extends Component {

  render() {
    return (
      <React.Fragment>
        <ControlPanel />
        <hr/>
        <DisplayPanel />
      </React.Fragment>
    )
  }
}

export default ContentController
