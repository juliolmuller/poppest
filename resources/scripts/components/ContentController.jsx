import React, { Component } from 'react'
import ControlPanel from './ControlPanel'
import DisplayPanel from './DisplayPanel'

class ContentController extends Component {

  state = {
    activeTab: 0
  }

  activateTab = activeTab => {
    this.setState({ activeTab })
  }

  displayContent = () => {
    if (this.state.activeTab) {
      return <DisplayPanel activeLang={this.state.activeTab} />
    }
  }

  render() {
    return (
      <React.Fragment>
        <ControlPanel
          activeLang={this.state.activeTab}
          activateTab={this.activateTab}
        />
        <hr/>
        {this.displayContent()}
      </React.Fragment>
    )
  }
}

export default ContentController
