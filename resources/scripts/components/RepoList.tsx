import React, { FC, useEffect, useState } from 'react'
import { Repository } from '../@types/models'
import RepoCard from './RepoCard'
import RepoModal from './RepoModal'
import { getRepositories } from '../services/api'
import loading from '../assets/loading.gif'

interface RepoListProps {
  activeLang: number
}

const RepoList: FC<RepoListProps> = (props) => {
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
          <img
            src={loading}
            alt="Loading animation"
            style={{ width: '100%', maxWidth: '600px' }}
          />
        </div>
      ) : (
        <div className="row">
          {repositories.map((repo, index) => (
            <RepoCard
              key={index}
              repo={repo}
              showDetails={toggleDetails}
            />
          ))}
        </div>
      )}

      {visibleDetails && (
        <RepoModal
          repo={detailsFor as Repository}
          hideDetails={toggleDetails}
        />
      )}
    </>
  )
}

export default RepoList
