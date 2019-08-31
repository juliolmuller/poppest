import React, { Component } from 'react'
import PropTypes from 'prop-types'
import Repo from './Repo'
import Modal from './Modal'
import api from './../services/ApiConsumer'
import loading from './../assets/loading.gif'

class DisplayPanel extends Component {

  state = {
    isLoading: false,
    repositories: [],
    visibleDetails: false,
    detailsFor: null
  }

  componentDidMount() {
    this.componentDidUpdate(this.props.activeLang)
  }

  componentDidUpdate(prevProps) {
    if (this.props.activeLang !== prevProps.activeLang) {
      this.setState({ isLoading: true })
      api.getRepositories(this.props.activeLang)
        .then(response => this.setState({ repositories: response.data }))
        .catch(response => console.log(response))
        .finally(setTimeout(() => {
          this.setState({ isLoading: false })
        }, 500))
    }
  }

  toggleDetails = (repo = null) => {
    this.setState({
      visibleDetails: !!repo,
      detailsFor: repo || {}
    })
  }

  getDetails = () => {
    if (this.state.visibleDetails) {
      return <Modal repo={this.state.detailsFor} hideDetails={this.toggleDetails} />
    }
  }

  render() {
    return (
      <div className="content">
        <div className={`content text-center ${this.state.isLoading ? '' : 'd-none'}`}>
          <img src={loading} alt="Loading animation" />
        </div>
        <div className={`row ${this.state.isLoading ? 'd-none' : ''}`}>
          {
            this.state.repositories.map((repo, index) => {
              return (
                <Repo
                  key={index}
                  repo={repo}
                  showDetails={this.toggleDetails}
                />
              )
            })
          }
        </div>
        {this.getDetails()}
      </div>
    )
  }
}

DisplayPanel.propTypes = {
  activeLang: PropTypes.number
}

export default DisplayPanel
