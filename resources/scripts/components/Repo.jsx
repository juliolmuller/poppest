import React from 'react'
import PropTypes from 'prop-types'
import star from './../assets/icon-star.svg'
import fork from './../assets/icon-fork.svg'

function Repo(props) {
  return (
    <div className="col-12 col-sm-6 col-lg-4">
      <div className="card border border-pop mb-3" onClick={props.showDetails.bind(this, props.repo)}>
        <div className="card-body">
          <img src={props.repo.avatar} className="figure-fluid rounded float-left mt-2" style={{ maxHeight: '4em' }} alt="Repository avatar" />
          <div className="text-left" style={{ marginLeft: '5em' }}>
            <h4 className="card-subtitle text-truncate">
              <small>by {props.repo.owner}</small>
            </h4>
            <h3 className="card-title text-truncate">
              {props.repo.name}
            </h3>
            <div className="d-inline">
              <img src={star} alt="Icon for stars count" aria-hidden="true" />
              {props.repo.stars}
            </div>
            <div className="d-inline ml-3">
              <img src={fork} alt="Icon for forks count" aria-hidden="true" />
              {props.repo.forks}
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

Repo.propTypes = {
  repo: PropTypes.object.isRequired,
  showDetails: PropTypes.func.isRequired
}

export default Repo
