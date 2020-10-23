import React, { FC, useEffect, useState } from 'react'
import { Repository } from '../@types/models'
import Repo from './Repo'
import Modal from './Modal'
import { getRepositories } from '../services/api'
import loading from '../assets/loading.gif'

interface DisplayPanelProps {
  activeLang: number
}

const DisplayPanel: FC<DisplayPanelProps> = (props) => {
  const [repositories, setRepositories] = useState<Repository[]>([])
  const [detailsFor, setDetails] = useState<Repository | Record<string, unknown>>({})
  const [visibleDetails, setVisibleDetails] = useState(false)
  const [isLoading, setIsLoading] = useState(false)

  useEffect(() => {
    setIsLoading(true)
    getRepositories(props.activeLang)
      .then((response) => setRepositories(response.data))
      .finally(() => setIsLoading(false))
  }, [props.activeLang])

  const toggleDetails = (repo?: Repository) => {
    setVisibleDetails(Boolean(repo))
    setDetails(repo || {})
  }

  return (
    <>
      {isLoading ? (
        <div className="text-center">
          <img src={loading} style={{ width: '100%', maxWidth: '600px' }} alt="Loading animation" />
        </div>
      ) : (
        <div className="row">
          {repositories.map((repo, index) => (
            <Repo key={index} repo={repo} showDetails={toggleDetails} />
          ))}
        </div>
      )}

      {visibleDetails && (
        <Modal repo={detailsFor as Repository} hideDetails={toggleDetails} />
      )}
    </>
  )
}

export default DisplayPanel
