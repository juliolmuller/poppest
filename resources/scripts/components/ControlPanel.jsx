import React, { Component } from 'react'
import PropTypes from 'prop-types'
import api from './../services/ApiConsumer'
import loading from './../assets/loading.gif'

class ControlPanel extends Component {

  state = {
    languages: []
  }

  componentDidMount() {
    api.getLanguages()
      .then(response => this.setState({ languages: response.data }))
      .catch(response => console.log(response))
  }

  render() {
    return (
      <React.Fragment>
        <div className="row">
          <div className="col-xs-12 col-sm-10">
            <h2 className="content-header">
              Pick your favorite language:
            </h2>
          </div>
          <div className="col-xs-12 col-sm-2">
            <button id="refresh-btn" type="button" className="btn btn-lg btn-outline-pop btn-block">
              Refresh
            </button>
          </div>
        </div>
        <div className="row">
          <div className="progress col-sm-12">
            <div className="progress-bar progress-bar-striped progress-bar-animated bg-pop" role="progressbar" style={{ width: '100%' }} aria-valuemax="100"></div>
          </div>
        </div>
        <nav id="navbar" className="nav nav-pills nav-fill">
          {
            this.state.languages.map(lang => {
              return (
                <button
                  key={lang.id}
                  type="button"
                  id={`activate-lang-${lang.id}`}
                  className={`btn btn-outline-pop nav-item ${this.props.activeLang === lang.id ? 'active' : ''}`}
                  onClick={this.props.activateTab.bind(this, lang.id)}
                >{lang.name}</button>
              )
            })
          }
        </nav>
        <div id="panel-main">
          <div id="panel-board-{{ $language->id }}" style={{ display: 'none' }}>
            <div id="panel-loading-{{ $language->id }}" className="content text-center">
              <img src={loading} alt="Loading animation" />
            </div>
            <div id="panel-content-{{ $language->id }}" style={{ display: 'none' }}></div>
          </div>
        </div>
      </React.Fragment>
    )
  }
}

ControlPanel.propTypes = {
  activeLang: PropTypes.number,
  activateTab: PropTypes.func.isRequired
}

export default ControlPanel
